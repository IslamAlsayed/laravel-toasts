<?php

namespace Halaby\Toasts;

class ToastManager
{
    public function add(string $type, string $message = null)
    {
        $toast = new ToastFactory($type, $message);
        $toasts = session()->get('toasts', []);
        $toasts[] = $toast;
        session()->flash('toasts', $toasts);
        return $toast;
    }
}