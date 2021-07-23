<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class BuildExceptions extends \Exception
{
    protected $shortMessage;
    protected $message;
    protected $code;
    protected $description;
    protected $help;
    protected $transportedMessage;
    protected $httpCode;
    protected $transportedData;

    public function __construct(array $exception)
    {
        $this->shortMessage       = data_get($exception, 'shortMessage', 'internalError');
        $this->message            = data_get($exception, 'message', trans('exceptions.internal_error'));
        $this->description        = data_get($exception, 'description', '');
        $this->help               = data_get($exception, 'help', '');
        $this->transportedMessage = data_get($exception, 'transportedMessage', '');
        $this->httpCode           = data_get($exception, 'httpCode', Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->transportedData    = data_get($exception, 'transportedData', '');

        $this->code = $this->shortMessage;
        parent::__construct();
    }

    public function render(): Response
    {
        return response($this->getError(), $this->httpCode);
    }

    public function getError(): array
    {
        return [
            'error' => [
                'shortMessage'       => $this->shortMessage,
                'message'            => $this->message,
                'description'        => $this->description,
                'help'               => $this->help,
                'transportedMessage' => $this->transportedMessage,
                'transportedData'    => $this->transportedData
            ]
        ];
    }

    public function getShortMessage(): string
    {
        return (string) $this->shortMessage;
    }
}
