<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;

class RealtimeMessage extends Component
{
    use LivewireAlert;

    public $uNotifications = [];

    #[On('echo:my-channel,RealtimeMessageEvent')]
    public function handleRealtimeMessage($message): void
    {
        $this->uNotifications[] = $message['message'];
        $this->alert('success', 'User : ' . $message['message'], [
            'timerProgressBar' => true,
            'position' => 'center',
            'timer' => 15000,
            'toast' => false,
            'text' => 'Realtime Message',
            'allowOutsideClick' => true,
            'icon' => 'success',
        ]);
    }
    public function render()
    {
        return view('livewire.realtime-message');
    }
}
