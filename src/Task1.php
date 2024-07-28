<?php
// TODO: 1) Узнать количество контактов с заполненным полем COMMENTS.

function task1 (): void
{
    $contacts = [];
    $start = 0;
    do {
        $response = bitrix24_request('crm.contact.list', [
            'start' => $start,
            'filter' => ['!COMMENTS' => false]
        ]);

        if (isset($response['result'])) {
            $contacts = array_merge($contacts, $response['result']);
            $start += 50;
        }
    } while (!empty($response['result']));

    $countWithComments = count($contacts);

    echo '[count_with_comments] => ' . $countWithComments . PHP_EOL;
}
