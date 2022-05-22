<?php
header('Content-Type: application/json; charset=utf-8');
$token = "WebteToken";
if(isset($_GET['token']))
    if (strcmp($_GET['token'], $token) == 0){
        if (isset($_GET['r']) && isset($_GET['priklad']))
            http_response_code(400);
        else if(isset($_GET['r']) && is_numeric($_GET['r'])){
            $r = $_GET['r'];
            $command = 'octave-cli --eval "
            pkg load control;
            m1 = 2500; m2 = 320;
            k1 = 80000; k2 = 500000;
            b1 = 350; b2 = 15020;
            A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];
            B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];
            C=[0 0 1 0]; D=[0 0];
            Aa = [[A,[0 0 0 0]\'];[C, 0]];
            Ba = [B;[0 0]];
            Ca = [C,0]; Da = D;
            K = [0 2.3e6 5e8 0 8e6];
            sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);
            t = 0:0.01:5;
            r ='.$r.';
            initX1=0;
            initX1d=0;
            initX2=0;
            initX2d=0;
            [y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);
            [y,t,x]
            "';

            $data = [
                'y' =>[],
                't' => [],
                'x' => [],
            ];
            $output = [];
            exec($command, $output);

            foreach ($output as $row){
                $rawNumbers = explode(" ", $row);
                $numbers = [];
                foreach ($rawNumbers as $value){
                    if ($value != ""){
                        $numbers[] =(float)$value;

                    }
                }
                if (count($numbers) == 7){
                    $data['y'][] = $numbers[0];
                    $data['t'][] = $numbers[1];
                    $data['x'][] = [
                        $numbers[2],
                        $numbers[3],
                        $numbers[4],
                        $numbers[5],
                        $numbers[6]
                    ];
                }
            }
            http_response_code(200);
            echo json_encode($data);
        }else if(isset($_GET['priklad'])){
//            $dsa=urlencode("[0 2.3e6 5e8 0 8e6]);
//            echo $dsa;
//            echo "<br>";
            $priklad = $_GET['priklad'];

            $command = 'octave-cli --eval "       
            priklad ='.$priklad.';
            priklad
            "';
            $output = [];
            exec($command, $output);

            $result = implode('', $output);
            $result = preg_replace('!\s+!', ' ', $result);

            $result = str_replace("priklad = ","",$result);

            $data = [
               'result' => $result

            ];
            echo json_encode($data);
        }
    }else
        http_response_code(400);

else
    http_response_code(401);
