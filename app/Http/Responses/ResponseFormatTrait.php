<?php

namespace App\Http\Responses;

use App\Exceptions\ExceptionCode;

trait ResponseFormatTrait
{
    /**
     * Check accept content-type, then return related
     * response content in terms of content-type
     *
     * Notice: template path will be parsed by template name
     *         and response contentType, the rule as below:
     *         templatePath = templateName-respContentType.blade.php
     *         for example common.navigation with json format will be
     *         resource/views/common/navigation-json.blade.php
     *
     * @param string $template  template name
     * @param array $data       data need by template
     * @param string $message
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    protected function render(
        $template,
        array $data = [],
        $message = '',
        $code = 0
    ) {
        return $this->genResponse($template, [
            'code'      => $code,
            'data'      => $data,
            'message'   => $message,
        ]);
    }

    /**
     * Response info message
     *
     * @param string $message
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderInfo($message) {
        return $this->genResponse('infos.info', [
            'code'      => 0,
            'data'      => [],
            'message'   => $message,
        ]);
    }

    /**
     * Responses error  message
     *
     * @param \Exception|string $data   exception or error message
     * @param int $code         error code
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderError(
        $data,
        $code = ExceptionCode::GENERAL
    ) {
        $template = 'errors.custom';
        if ($data instanceof \Exception) {
            $code = $data->getCode() ?: $code;
            $message = $data->getMessage();

            // in case debug enabled
            if (config('app.debug')) {
                $exception['trace'] = $data->getTrace();
                $exception['line'] = $data->getLine();
                $exception['file'] = $data->getFile();
            }

            return $this->genResponse($template, [
                'code'      => $code,
                'data'      => [],
                'message'   => $message,
                'exception' => empty($exception) ? [] : $exception,
            ]);
        }

        return $this->genResponse($template, [
            'code'      => $code,
            'data'      => [],
            'message'   => $data,
        ]);
    }

    /**
     * Get response format and contentType
     */
    protected function getResponseFormat()
    {
        static $respFormats = [
            'json'      => 'application/json',
            'xml'       => 'text/xml',
            'txt'       => 'text/plain',
            'html'      => 'text/html',
        ];
        $respFormat = request()->format();
        if ( ! isset($respFormats[$respFormat])) {
            $respFormat = 'txt';
        }
        $respContentType = $respFormats[$respFormat];

        return [$respFormat, $respContentType];
    }

    /**
     * Generate response
     *
     * @param string $template  template name
     * @param array $data
     *
     * @return \Illuminate\Http\Response
     */
    protected function genResponse($template, array $data)
    {
        list($respFormat, $respContentType) = $this->getResponseFormat();
        $template = rtrim($template, '.') . '-' . $respFormat;
        return response()
            ->view($template, [
                'code'      => $data['code'],
                'data'      => $data['data'],
                'message'   => $data['message'],
                'exception' => isset($data['exception']) ? $data['exception'] : [],
            ])
            ->header('Content-Type', $respContentType);
    }
}
