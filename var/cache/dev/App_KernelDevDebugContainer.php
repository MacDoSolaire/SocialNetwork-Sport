<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

<<<<<<< HEAD
if (\class_exists(\ContainerVKv95VY\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVKv95VY/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerVKv95VY.legacy');
=======
if (\class_exists(\ContainerBVXKGGF\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerBVXKGGF/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerBVXKGGF.legacy');
>>>>>>> 9a0057f42942eea01086beac3fe966b720039a79

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
<<<<<<< HEAD
    \class_alias(\ContainerVKv95VY\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerVKv95VY\App_KernelDevDebugContainer([
    'container.build_hash' => 'VKv95VY',
    'container.build_id' => '96824629',
    'container.build_time' => 1613317840,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVKv95VY');
=======
    \class_alias(\ContainerBVXKGGF\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerBVXKGGF\App_KernelDevDebugContainer([
    'container.build_hash' => 'BVXKGGF',
    'container.build_id' => 'ee28936c',
    'container.build_time' => 1613402711,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerBVXKGGF');
>>>>>>> 9a0057f42942eea01086beac3fe966b720039a79
