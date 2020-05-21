<?php
$train_file = (dirname(__FILE__) . "/Contrastinator.net");
if (!is_file($train_file))
    die("Contrastinator.net has not been created! Please run TrainContrastinator.php to generate it" . PHP_EOL);

$ann = fann_create_from_file($train_file);
if ($ann) {
    
    foreach(range(-1, 1, 0.1) as $test_input_value){
        
        $input = array($test_input_value);
        $result = fann_run($ann, $input);
        $darker = $result[0];
        $brighter = $result[1];
        
        if($brighter < 0 && $darker < 0){
            $evaluation = 'Neutral';
        }
        elseif($brighter > $darker){
            $evaluation = 'Brighter';
        }
        elseif($brighter < $darker){
            $evaluation = 'Darker';
        }                
                
        echo 'Contrastinator(' . $input[0] . ") -> [$darker, $brighter] - Input is $evaluation" . PHP_EOL; 
    }
        
    fann_destroy($ann);
} else {
    die("Invalid file format" . PHP_EOL);
}

/*
Results: 

Contrastinator(-1) -> [1, -1] - Input is Darker
Contrastinator(-0.9) -> [1, -1] - Input is Darker
Contrastinator(-0.8) -> [1, -1] - Input is Darker
Contrastinator(-0.7) -> [1, -1] - Input is Darker
Contrastinator(-0.6) -> [1, -1] - Input is Darker
Contrastinator(-0.5) -> [1, -1] - Input is Darker
Contrastinator(-0.4) -> [1, -1] - Input is Darker
Contrastinator(-0.3) -> [1, -1] - Input is Darker
Contrastinator(-0.2) -> [1, -1] - Input is Darker
Contrastinator(-0.1) -> [1, -1] - Input is Darker
Contrastinator(0) -> [-0.9997798204422, -0.99950748682022] - Input is Neutral
Contrastinator(0.1) -> [-1, 0.9995544552803] - Input is Brighter
Contrastinator(0.2) -> [-1, 0.99954569339752] - Input is Brighter
Contrastinator(0.3) -> [-1, 0.99953877925873] - Input is Brighter
Contrastinator(0.4) -> [-1, 0.9995334148407] - Input is Brighter
Contrastinator(0.5) -> [-1, 0.99952918291092] - Input is Brighter
Contrastinator(0.6) -> [-1, 0.9995259642601] - Input is Brighter
Contrastinator(0.7) -> [-1, 0.99952346086502] - Input is Brighter
Contrastinator(0.8) -> [-1, 0.99952149391174] - Input is Brighter
Contrastinator(0.9) -> [-1, 0.99952000379562] - Input is Brighter
Contrastinator(1) -> [-1, 0.99951887130737] - Input is Brighter
*/
