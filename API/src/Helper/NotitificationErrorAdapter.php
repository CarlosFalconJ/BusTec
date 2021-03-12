<?php


namespace App\Helper;


use App\Helper\NotificationError;

abstract  class NotitificationErrorAdapter
{
    protected $notificationErrors;

    public function setNotificationErrors(NotificationError $ne)
    {
        $this->notificationErrors = $ne;
    }

    public function validate($data)
    {
        try {
            $this->getValidation($data)->assert($data);
            $isValid = true;
        } catch (\Exception $ex) {
            $isValid = false;
            $this->setErrors($ex, $data);
        }

        return $isValid;
    }

    protected function setErrors(\Exception $ex, $data)
    {
        $mensagensDeErro = $this->getErrorsMessages($data);

        $todosOsErrors = $ex->getTrace();

        foreach ($todosOsErrors as $idx => $msg) {

            if(strlen($msg) > 0){
                $valor  = $mensagensDeErro[$idx][0];
                $params = $mensagensDeErro[$idx][1];

                $this->notificationErrors->addErro($idx, $valor, $params);
            }
        }
    }

    abstract protected function getValidation($data);
    abstract protected function getErrorsMessages($data);
}