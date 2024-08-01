<?php

namespace App\Observers;

use App\Models\Training;

class TrainingObserver
{
    public function created(Training $training)
    {
        //TODO: lógica de observador de criação de treinamento.
    }

    public function updated(Training $training)
    {
        //TODO: lógica de observador de edição de treinamento.
    }

    public function deleted(Training $training)
    {
        //TODO: lógica de observador de deleção de treinamento.
    }
}
