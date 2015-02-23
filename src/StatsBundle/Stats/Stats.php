<?php

namespace StatsBundle\Stats;

use Doctrine\ORM\EntityManager;
use StatsBundle\Entity\Stat;

/*
 * USAGE:
 *  $this->get('stats')->add('view.index');
 *  $this->get('stats')->addError('importacion', ["detalle"=>"falta la tabla"]);
 *  $this->get('stats')->addInfo('importacion', ["marca"=>"mazda"]);
 *  $this->get('stats')->addCounter('view.index.visits');
 *  $this->get('stats')->add('view.index.ms', 2034, ["params" => ["id"=>4, "slug"=>"/seat"]]);
 */
class Stats
{
    protected $em;

    protected $sources;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function add($metric, $value = null, $info = null)
    {
        try {
            $stat = new Stat($metric, $value, $info);
            $this->em->persist($stat);
            $this->em->flush();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function addCounter($metric, $value = 1)
    {
        $stat = $this->em->getRepository('StatsBundle:Stat')->findOneByMetric($metric);

        if (!is_object($stat)) {
            return $this->add($metric, $value);
        } else {
            $stat->add($value);
            $this->em->flush();
        }
    }

    public function addError($metric, $info)
    {
        return $this->add("error.".$metric, null, $info);
    }

    public function addInfo($metric, $info)
    {
        return $this->add($metric, null, $info);
    }

    public function get($metric)
    {
        return $this->em->getRepository('StatsBundle:Stat')->findOneByMetric($metric);
    }

    public function getValue($metric)
    {
        $stat = $this->get($metric);

        return is_object($stat) ? $stat->getValue() : null;
    }

    public function getInfo($metric)
    {
        $stat = $this->get($metric);

        return is_object($stat) ? $stat->getInfo() : null;
    }
}
