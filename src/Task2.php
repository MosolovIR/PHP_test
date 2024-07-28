<?php

// TODO: 2) Найти все сделки без контактов, сделать предположение почему они без контактов.

function task2 (): void
{
    $dealsWithoutContacts = [];
    $start = 0;

    do {
        $response = bitrix24_request('crm.deal.list', [
            'start' => $start,
            'filter' => ['CONTACT_ID' => '']
        ]);
        if (isset($response['result'])) {
            $dealsWithoutContacts[] = array_merge($dealsWithoutContacts, $response['result']);
            $start += 50;
        }
    } while (!empty($response['result']));

    $countWithoutContacts = count($dealsWithoutContacts);

    echo '[count_without_contacts] => ' . $countWithoutContacts . PHP_EOL;
}
