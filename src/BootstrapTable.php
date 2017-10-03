<?php
/**
 * Created by PhpStorm.
 * User: johankladder
 * Date: 29-9-17
 * Time: 14:22
 */

namespace JohanKladder\BootstrapTable;


class BootstrapTable
{

    const MAIN_CLASS = 'table-responsive';
    const TABLE_CLASS = 'table';

    static $HEADERS = [];

    public static function create(array $data = array())
    {
        return html()->div(
            self::generateTable($data)
        )->class(self::MAIN_CLASS);
    }

    private static function generateTable(array $data)
    {
        return '<table class="' . self::TABLE_CLASS . '">' .
            self::generateHeaders($data)
            . self::generateTableBody($data)
            . '</table>';
    }

    private static function generateHeaders(array $data)
    {
        return '<thead>' . self::generateHeaderContent($data) . '</thead>';
    }

    private static function generateHeaderContent(array $data)
    {
        $html = '';
        foreach (self::extractHeaders($data) as $header) {
            $html .= self::generateHeaderContentPerHeader($header);
        }
        return $html;
    }

    private static function extractHeaders(array $data)
    {
        self::$HEADERS = $data['headers'];
        return $data['headers']; // TODO: Model support!
    }

    private static function generateHeaderContentPerHeader($header)
    {
        if (is_array($header)) {
            $header = $header['label'];
        }
        return '<th>' . __("messages.{$header}") . '</th>';
    }

    private static function generateTableBody(array $data)
    {
        /** @var DataProvider $dataProvider */
        $dataProvider = $data['dataProvider'];
        $entities = $dataProvider->getEntities();

        return '<tbody>' .
            self::generateTableBodyFromData($entities)
            . '</tbody>';
    }

    private static function generateTableBodyFromData($bodyData)
    {
        $html = '';
        foreach ($bodyData as $entityData) {
            $html .= self::generateTableBodyRow($entityData);
        }
        return $html;
    }

    private static function generateTableBodyRow($entityData)
    {
        return '<tr>' .
            self::generateTableBodyData($entityData)
            . '</tr>';
    }

    private static function generateTableBodyData($entityData)
    {
        $html = '';
        foreach (self::$HEADERS as $headerKey) {
            $key = $headerKey;
            $data = null;
            if (is_array($headerKey)) {
                $data = call_user_func($headerKey['value'], $entityData);
            } else {
                $data = $entityData[$key];
            }
            $html .= '<td>' . $data . '</td>';
        }
        return $html;
    }

}