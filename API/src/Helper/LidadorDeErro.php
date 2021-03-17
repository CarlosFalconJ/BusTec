<?php


namespace App\Helper;


use Doctrine\DBAL\Exception\DriverException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class LidadorDeErro implements EventSubscriberInterface
{
    public $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION=>[
                ['handle404Exception', -1],
                ['AppError', 1],
                ['handleGenericException', 0]
            ]];
    }

    public function AppError(ExceptionEvent $event){
        if ($event->getThrowable()instanceof \Error)
        {
            $this->logger->error('Um Erro interno ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
            $response = $this->Erro($event->getThrowable());
            $event->setResponse($response->getResponse());
        }
        if ($event->getThrowable()instanceof DriverException)
        {
            $this->logger->error('Uma exceção ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
            $response = $this->Erro($event->getThrowable());
            $event->setResponse($response->getResponse());
        }
    }

    public function handle404Exception(ExceptionEvent $event)
    {
        if ($event->getThrowable()instanceof NotFoundHttpException)
        {
            $this->logger->error('Uma exceção ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
            $response = $this->Erro($event->getThrowable());
            $event->setResponse($response->getResponse());
        }
    }

    function handleGenericException(ExceptionEvent $event)
    {
        $this->logger->error('Uma exceção ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
        $response = $this->Erro($event->getThrowable());
        $event->setResponse($response->getResponse());
    }
    public static function Erro(\Throwable $erro)
    {
        return new \Exception(['mensagem' => $erro->getMessage(), 'status_code' => $erro->getCode(), 'stack' => $erro->getTrace()]);
    }



}