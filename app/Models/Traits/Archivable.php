<?php

namespace TTT\Models\Traits;

use DB;

trait Archivable
{
    public function scopeArchive($query)
    {
         return $query->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->groupBy('year')
            ->groupBy('month');
    }

    public function scopeFromArchive($query, $year, $month = null)
    {
        $query = $this->whereRaw('YEAR(created_at) = ?', [$year]);

        if (!is_null($month)) {
            return $query->whereRaw('MONTH(created_at) = ?', [$month]);
        }

        return $query;
    }
}
