<?php

namespace App\Observers;

use App\Models\Training;

class TrainingObserver
{
    public function created(Training $training)
    {
        // Lógica quando um treinamento é criado
    }

    public function updated(Training $training)
    {
        // Lógica quando um treinamento é atualizado
    }

    public function deleted(Training $training)
    {
        // Lógica quando um treinamento é deletado
    }
}
