<?php

$num_input = 1;
$num_output = 2;
$num_layers = 3;
$num_neurons_hidden = 2;
$desired_error = 0.000001;
$max_epochs = 500000;
$epochs_between_reports = 1000;

$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);

if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

    $filename = dirname(__FILE__) . "/Contrastinator.data";
    if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error))
        echo 'Contrastinator trained.' . PHP_EOL;

    if (fann_save($ann, dirname(__FILE__) . "/Contrastinator.net"))
        echo 'Contrastinator.net saved.' . PHP_EOL;

    fann_destroy($ann);
}
