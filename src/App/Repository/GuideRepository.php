<?php

namespace App\Repository;

use App\Repository;

class GuideRepository extends Repository
{
    public function getTableName()
    {
        return 'guides';
    }

    public function save(array $data)
    {
        $this->insert($data);
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        return $this->db->fetchAll(sprintf("
                select g.id, p.name from %s g
                left join provider p ON p.id = g.id_provider",
                $this->getTableName()
            )
        );
    }
}