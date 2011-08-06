<?php

namespace Bazinga\ExposeRoutingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

use Bazinga\ExposeRoutingBundle\Extractor\ExposedRoutesExtractorInterface;


/**
 * Controller class.
 *
 * @package     ExposeRoutingBundle
 * @subpackage  Controller
 * @author William DURAND <william.durand1@gmail.com>
 */
class Controller
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected $engine;
    /**
     * @var \Bazinga\ExposeRoutingBundle\Extractor\ExposedRoutesExtractorInterface
     */
    protected $exposedRoutesExtractor;

    /**
     * Default constructor.
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface                The template engine.
     * @param \Bazinga\ExposeRoutingBundle\Extractor\ExposedRoutesExtractorInterface    The extractor service.
     */
    public function __construct(EngineInterface $engine, ExposedRoutesExtractorInterface $exposedRoutesExtractor)
    {
        $this->engine = $engine;
        $this->exposedRoutesExtractor = $exposedRoutesExtractor;
    }

    /**
     * indexAction action.
     */
    public function indexAction($_format)
    {
        return $this->engine->renderResponse('BazingaExposeRoutingBundle::index.' . $_format . '.twig', array(
            'var_prefix'        => '{',
            'var_suffix'        => '}',
            'prefix'            => $this->exposedRoutesExtractor->getBaseUrl(),
            'exposed_routes'    => $this->exposedRoutesExtractor->getRoutes(),
        ));
    }
}
