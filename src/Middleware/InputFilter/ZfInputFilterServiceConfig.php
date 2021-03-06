<?php

namespace Reliv\PipeRat\Middleware\InputFilter;

use Psr\Http\Message\ServerRequestInterface as Request;
use Reliv\PipeRat\Middleware\Middleware;
use Reliv\PipeRat\ZfInputFilter\Hydrator\ZfInputFilterErrorHydrator;
use Zend\InputFilter\InputFilterInterface;
use ZfInputFilterService\InputFilter\ServiceAwareFactory;
use ZfInputFilterService\InputFilter\ServiceAwareInputFilter;

/**
 * Class ZfInputFilterServiceConfig
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ZfInputFilterServiceConfig extends AbstractZfInputFilter implements Middleware
{
    /**
     * @var ServiceAwareFactory
     */
    protected $serviceAwareFactory;

    /**
     * Constructor.
     *
     * @param ZfInputFilterErrorHydrator $zfInputFilterErrorHydrator
     * @param ServiceAwareFactory        $serviceAwareFactory
     */
    public function __construct(
        ZfInputFilterErrorHydrator $zfInputFilterErrorHydrator,
        ServiceAwareFactory $serviceAwareFactory
    ) {
        $this->serviceAwareFactory = $serviceAwareFactory;
        parent::__construct(
            $zfInputFilterErrorHydrator
        );
    }

    /**
     * getInputFilter
     *
     * @param Request $request
     *
     * @return InputFilterInterface
     */
    protected function getInputFilter(Request $request)
    {
        $filterConfig = $this->getOption($request, 'config', []);

        return new ServiceAwareInputFilter(
            $this->serviceAwareFactory,
            $filterConfig
        );
    }
}
