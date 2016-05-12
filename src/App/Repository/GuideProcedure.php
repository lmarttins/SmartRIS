<?php

namespace App\Repository;

use App\Repository;

class GuideProcedure extends Repository
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
            foreach (explode(', ', $data['procedures']) as $key => $value) {
                $result = $this->insert(array(
                    'id_guide' => $data['guide'],
                    'id_procedure' => $value
                ));
            }
        }

        return $result;
    }
}