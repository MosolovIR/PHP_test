<?php

// TODO: 3) Узнать сколько сделок в каждой из существующих Направлений.

function task3(): void
{
    $dealCategories = bitrix24_request('crm.dealcategory.list');
    $dealCategoryCount = [];

    if (isset($dealCategories['result'])) {
        foreach ($dealCategories['result'] as $category) {
            $categoryId = $category['ID'];
            $start = 0;
            do {
                $response = bitrix24_request('crm.deal.list', [
                    'start' => $start,
                    'filter' => ['CATEGORY_ID' => $categoryId],
                    'select' => ['ID']
                ]);
                if (isset($response['result'])) {
                    if (!isset($dealCategoryCount[$categoryId])) {
                        $dealCategoryCount[$categoryId] = 0;
                    }
                    $dealCategoryCount[$categoryId] += count($response['result']);
                    $start += 50;
                }
            } while (!empty($response['result']));
        }
    }
    echo '[categories] => ' . json_encode($dealCategoryCount) . PHP_EOL;
}
