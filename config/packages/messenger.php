<?php

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework) {
    $framework->messenger()->defaultBus(value: 'bus');

    $bus = $framework->messenger()->bus(name: 'bus');
    $bus->middleware()->id(value:'validation');

    $framework->messenger()
        ->transport(name: 'bus')
        ->dsn(value: 'sync://');
};