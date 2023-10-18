<?php

function to2DArray($data, $key)
{
    $ret = [];
    foreach ($data as $d) {
        $ret[] = [$key => $d];
    }
    return $ret;
}

function getNewAndUpdates($new, $existing)
{
    return [
        'new' => array_diff_key($new, $existing),
        'updates' => array_intersect_key($new, $existing)
    ];
}

function flatten($arr, $key = False)
{
    $ret = [];
    foreach ($arr as $k => $a) {
        foreach ($a as $aa) {
            if ($key) {
                $ret[$k] = $aa;
            } else {
                $ret[] = $aa;
            }
        }
    }
    return $ret;
}

// function transform($arr, $fields)
// {
//     $ret = [];
//     foreach ($arr as $k => $a) {
//         $ret[$k] = $a;
//         foreach ($fields as $sk => $tk) {
//             $ret[$k][$tk] = $a[$sk];
//             unset($ret[$k][$sk]);
//         }
//     }
//     return $ret;
// }

function merge($target, $source, $key, $fields)
{
    $ret = [];
    foreach ($target as $tk => $tv) {
        if (isset($source[$tv[$key]])) {
            $src = $source[$tv[$key]];
            $ret[$tk] = $target[$tk];
            foreach ($fields as $fs => $ft) {
                $ret[$tk][$ft] = $src[$fs];
            }
        }
    }
    return $ret;
}

// function count($arr, $val, $key)
// {
//     $count = 0;
//     foreach ($arr as $a) {
//         if ($a[$key] == $val) {
//             $count++;
//         }
//     }
//     return $count;
// }

// function broadcast($arr, $vals, $keys)
// {
//     for ($i = 0; $i < count($vals); $i++) {
//         foreach ($arr as $k => $a) {
//             $arr[$k][$keys[$i]] = $vals[$i];
//         }
//     }
//     return $arr;
// }

function associativeToArray($arr)
{
    $ret = array();
    if ($arr == NULL) return $ret;
    foreach ($arr as $a) {
        $ret[] = $a;
    }
    return $ret;
}

function keyValue($arr, $key, $value = NULL)
{
    $ret = array();
    if ($arr == NULL) return $ret;
    foreach ($arr as $a) {
        $ret[$a[$key]] = $value != NULL ? $a[$value] : $a;
    }
    return $ret;
}

// arr: [{a: 'gg', b: 'wp'}, {a: 'ee', b: 'tt'}]
// key: a
// output: ['gg', 'ee']
function toOneDimension($arr, $key, $object = FALSE)
{
    $ret = array();
    if ($arr == NULL) return $ret;
    foreach ($arr as $a) {
        if ($object) {
            $ret[$a[$key]] = $a[$key];
        } else {
            $ret[] = $a[$key];
        }
    }
    return $ret;
}

function slice($arr, $fields)
{
    $ret = array();
    if ($fields == NULL) return $ret;

    foreach ($fields as $f) {
        if (isset($arr[$f]) || array_key_exists($f, $arr))
            $ret[$f] = $arr[$f];
    }
    return $ret;
}

function slice2D($arr, $fields)
{
    $ret = [];
    foreach ($arr as $k => $a) {
        $ret[$k] = slice($a, $fields);
    }
    return $ret;
}

function selfGrouping($arr, $parentForeign, $childName)
{
    $ret = array();
    foreach ($arr as $a) {
        if ($a[$parentForeign] == null) {
            $ret[$a['id']] = $a;
            $ret[$a['id']][$childName] = array();
        }
    }

    foreach ($arr as $a) {
        if ($a[$parentForeign] != null) {
            $ret[$a[$parentForeign]][$childName][] = $a;
        }
    }

    return $ret;
}

function groupByRecursive2($arr, $columns, $childKeys, $parentFields, $childNames)
{
    if (count($columns) == 0) {
        return slice2D($arr, $parentFields[0]);
    }
    $childName = $childNames[0];
    $ret = groupBy2($arr, array_shift($columns), array_shift($childKeys), array_shift($parentFields), array_shift($childNames));

    foreach ($ret as $k => $r) {
        $ret[$k][$childName] = groupByRecursive2(flatten($r[$childName], count($columns) == 0), $columns, $childKeys, $parentFields, $childNames);
    }
    return $ret;
}



// arr: [{a: 'gg', b: 'wp'}, {a: 'gg', b: 'tt'}, {a: 'yy', b: 'oo'}]
// column: a
// output: ['gg': [{a: 'gg', b: 'wp'}, {a: 'gg', b: 'tt'}], 'yy': [{a: 'yy', b: 'oo'}]]
function groupBy2($arr, $column, $childKey, $parentField, $childName)
{

    $ret = array();
    foreach ($arr as $a) {
        $groupKey = $a[$column];
        if (!isset($ret[$groupKey])) {
            $ret[$groupKey] = slice($a, $parentField);
            $ret[$groupKey][$childName] = [];
        }
        if ($a[$childKey] == null) continue;
        if (!isset($ret[$groupKey][$childName][$a[$childKey]])) {
            $ret[$groupKey][$childName][$a[$childKey]] = [];
        }
        $ret[$groupKey][$childName][$a[$childKey]][] = $a;
    }
    return $ret;
}

function groupByRecursive($arr, $columns, $childKey)
{
    if (count($columns) == 0) return $arr;
    $ret = groupBy($arr, array_shift($columns), count($columns) == 0 ? $childKey : NULL);
    foreach ($ret as $k => $r) {
        $ret[$k] = groupByRecursive($r, $columns, $childKey);
    }
    return $ret;
}

// arr: [{a: 'gg', b: 'wp'}, {a: 'gg', b: 'tt'}, {a: 'yy', b: 'oo'}]
// column: a
// output: ['gg': [{a: 'gg', b: 'wp'}, {a: 'gg', b: 'tt'}], 'yy': [{a: 'yy', b: 'oo'}]]
function groupBy($arr, $column, $childKey = NULL)
{
    $ret = array();
    foreach ($arr as $a) {
        $groupName = $a[$column];
        if (!isset($ret[$groupName])) {
            $ret[$groupName] = array();
        }
        if ($childKey != NULL) {
            $ret[$groupName][$a[$childKey]] = $a;
        } else {
            $ret[$groupName][] = $a;
        }
    }
    return $ret;
}

function filter($arr, $cond)
{
    $ret = [];
    foreach ($arr as $k => $a) {
        $satisfy = true;
        foreach ($cond as $field => $value) {
            if (!isset($a[$field]) || $a[$field] != $value) $satisfy = $satisfy && false;
        }
        if ($satisfy == true) $ret[$k] = $a;
    }
    return $ret;
}

// arr: [{a: '###', b: 'wp'}, {a: 'gg', b: '###'}, {a: 'yy', b: '###'}]
// value: ###
// output: [{a: 'gg'}, {b: 'tt'}, {a: 'yy''}]
function deleteColumnWhere($arr = array(), $value)
{
    $ret = array();
    foreach ($arr as $a) {
        $item = array();
        foreach ($a as $cname => $cvalue) {
            if ($cvalue != $value) {
                $item[$cname] = $cvalue;
            }
        }
        $ret[] = $item;
    }
    return $ret;
}
