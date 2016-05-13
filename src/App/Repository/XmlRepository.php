<?php

namespace App\Repository;

use App\Repository;
use App\Repository\AllotmentGuideRepository;

class XmlRepository extends Repository
{
    public function getTableName()
    {
        return '';
    }

    public function findByLot($idLot)
    {
        $sql = "
            select ag.*, g.*, p.name as name_patient, a.id as id_lot, p.*, pv.* 
            from smartris.allotments_guides ag
            inner join guides g on g.id = ag.id_guide
            inner join allotments a on a.id = ag.id_allotment
            inner join patients p on p.id = g.id_patient
            inner join provider pv on pv.id = g.id_provider where a.id = {$idLot}
        ";

        return $this->db->fetchAll($sql);
    }
}