<?php

namespace App\Repository;

use App\Repository;
use App\Repository\AllotmentGuideRepository;

class AllotmentRepository extends Repository
{
    public function getTableName()
    {
        return 'allotments';
    }

    public function save()
    {
        $this->insert(array());
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        return $this->findAll();
    }
}