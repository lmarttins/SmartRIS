<?php

namespace App\Repository;

use App\Repository;
use App\Repository\AllotmentGuideRepository;

class AllotmentGuideRepository extends Repository
{
    public function getTableName()
    {
        return 'allotments_guides';
    }

    public function save(array $data)
    {
        foreach (explode(',', $data['guides']) as $key => $value) {
            $this->insert(array(
                'id_allotment' => $data['allotment'],
                'id_guide' => $value
            ));
        }
    }

    public function findAll()
    {
        return $this->findAll();
    }
}