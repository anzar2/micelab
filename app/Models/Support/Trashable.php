<?php
namespace App\Models\Support;
/**
 * Maybe should implement validation if the model has deleted_at and deleted,
 * but... i trust in the developer
 * 
 * Note: This trash system doesn't use more space on database. 
 * Each row has deleted flag. Trashed models are hidden from queries. 
 */
trait Trashable
{
    public function trash()
    {
        $this->deleted_at = now();
        $this->deleted = true;
        $this->save();
    }

    public function recover()
    {
        $this->deleted_at = null;
        $this->deleted = false;
        $this->save();
    }
}