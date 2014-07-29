<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 10:04 AM
 */

namespace Kata\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\UniqueIdHelper;

class Attendee
{
    private $name;
    private $uniqueId;

    /**
     * @param $name
     * @param UniqueIdHelper $uniqueIdHelper
     * @todo pass only the value of uniq_id
     */
    public function __construct($name, UniqueIdHelper $uniqueIdHelper)
    {
        $this->name = $name;
        $this->uniqueId = $uniqueIdHelper->get();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUniqueId()
    {
        return $this->uniqueId;
    }
} 