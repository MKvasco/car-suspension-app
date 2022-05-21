<?php
header('Content-Type: application/json; charset=utf-8');

$token = "WebteToken";
$r = "0.1";
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
$output = [];
$data = [
    'y' =>[
        '0' =>[],
    ],
    't' => [
        '0' =>[],
    ],
    'x' => [
        '0' =>[],
        '1' =>[],
        '2' =>[],
        '3' =>[],
        '4' =>[]
    ],
];

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
        $data['y']['0'][] = $numbers[0];
        $data['t']['0'][] = $numbers[1];
        $data['x']['0'][] = $numbers[2];
        $data['x']['1'][] = $numbers[3];
        $data['x']['2'][] = $numbers[4];
        $data['x']['3'][] = $numbers[5];
        $data['x']['4'][] = $numbers[6];
    }


}
echo json_encode($data);
