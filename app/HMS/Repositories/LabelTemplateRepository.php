<?php

namespace HMS\Repositories;

use HMS\Entities\LabelTemplate;

interface LabelTemplateRepository
{
    /**
     * Find a temple in the DB.
     *
     * @param string $templateName
     *
     * @return LabelTemplate|null
     */
    public function findOneByTemplateName($templateName);

    /**
     * Save temple to the DB.
     *
     * @param LabelTemplate $labelTemplate
     */
    public function save(LabelTemplate $labelTemplate);

    /**
     * Remove a temple from the DB.
     *
     * @param LabelTemplate $labelTemplate
     */
    public function remove(LabelTemplate $labelTemplate);

    /**
     * @param int $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateAll($perPage = 15, $pageName = 'page');
}
