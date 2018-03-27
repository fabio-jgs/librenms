<?php
/**
 * i-stars.inc.php
 *
 * -Description-
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    LibreNMS
 * @link       http://librenms.org
 * @copyright  2018 Fabio Meincheim
 * @author     Fabio Meincheim  <fabio.jgs@gmail.com>
 */

$ups_temperature_oid = '.1.3.6.1.2.1.33.1.2.7.0';
$ups_temperature = snmp_get($device, $ups_temperature_oid, '-Oqv');

if (!empty($ups_temperature) || $ups_temperature == 0) {
    $type           = 'i-stars';
    $index          = 0;
    $limit          = 110;
    $warnlimit      = 50;
    $lowlimit       = 0;
    $lowwarnlimit   = 6;
    $divisor        = 1;
    $temperature    = $ups_temperature / $divisor;
    $descr          = 'Battery Temperature';

    discover_sensor(
        $valid['sensor'],
        'temperature',
        $device,
        $ups_temperature_oid,
        $index,
        $type,
        $descr,
        $divisor,
        '1',
        $lowlimit,
        $lowwarnlimit,
        $warnlimit,
        $limit,
        $temperature
    );
}
