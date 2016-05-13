<?php

namespace App\Repository;

use App\Repository;

class GuideProcedureRepository extends Repository
{
    public function getTableName()
    {
        return 'guides_procedures';
    }

    /**
     * Save table 'guides_procedures'
     *
     * @param array $data
     * @return void
     */
    public function save(array $data)
    {
        $result = false;
        if (isset($data['procedures'])) {
            foreach (explode(',', $data['procedures']) as $key => $value) {
                $result = $this->insert(array(
                    'id_guide' => $data['guide'],
                    'id_procedure' => $value
                ));
            }
        }

        return $result;
    }

    public function findByGuide($id)
    {
        return $this->db->fecthAll("
            select * from TAB_18 t
            inner join guides_procedures gp on gp.id_procedure = t.CodTermo
            where gp.id_guide = {$id}
        ");
    }
}