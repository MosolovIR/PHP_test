<?php

// TODO: 4) Посчитать сумму значений поля "Баллы" (предварительно узнав его код) из всех существующих элементов Смарт процесса.

function task4(): void
{
    $fields = bitrix24_request('crm.type.fields', ['entityTypeId' => 1038]);
    $field_code = null;

    if (isset($fields['result'])) {
        foreach ($fields['result'] as $field) {
            if ($field['title'] == 'Баллы') {
                $field_code = $field['name'];
                break;
            }
        }
    }

    if ($field_code === null) {
        echo 'Поле "Баллы" не найдено!' . PHP_EOL;
    } else {
        $start = 0;
        $sum = 0;
        do {
            $response = bitrix24_request('crm.item.list', [
                'entityTypeId' => 1038,
                'start' => $start,
                'select' => [$field_code]
            ]);

            if (isset($response['result']['items'])) {
                foreach ($response['result']['items'] as $item) {
                    if (isset($item[$field_code])) {
                        $sum += (int)$item[$field_code];
                    }
                }
                $start += 50;
            }
        } while (!empty($response['result']['items']));

        echo '[points_sum] => ' . $sum . PHP_EOL;
    }
}
