<?php

namespace Reliv\PipeRat\Middleware\ResponseFormat;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Reliv\PipeRat\Middleware\AbstractMiddleware;

/**
 * Class AbstractResponseFormat
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractResponseFormat extends AbstractMiddleware
{
    /**
     * @var array
     */
    protected $defaultAcceptTypes = [];
    
    /**
     * isValidAcceptType
     *
     * @param Request $request
     *
     * @return bool
     */
    public function isValidAcceptType(Request $request)
    {
        $options = $this->getOptions($request);

        $validContentTypes = $options->get('accepts', $this->defaultAcceptTypes);

        // allow this for all check
        if (in_array('*/*', $validContentTypes)) {
            return true;
        }

        $contentTypes = $request->getHeader('Accept');

        foreach ($contentTypes as $contentType) {
            if (in_array($contentType, $validContentTypes)) {
                return true;
            }
        }

        return false;
    }
}
