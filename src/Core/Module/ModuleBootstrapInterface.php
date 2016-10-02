<?php

namespace Wambo\Core\Module;

use Wambo\Core\App;

interface ModuleBootstrapInterface
{
    public function __construct(App $app);
}