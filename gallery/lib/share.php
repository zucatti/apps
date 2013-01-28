<?php
/**
 * ownCloud
 *
 * @author Michael Gapczynski
 * @copyright 2012 Michael Gapczynski mtgap@owncloud.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OCA\Gallery\Share;

class Gallery implements \OCP\Share_Backend {

	public function isValidSource($itemSource, $uidOwner) {
		return is_array(\OC\Files\Cache\Cache::getById($itemSource));
	}

	public function generateTarget($filePath, $shareWith, $exclude = null) {
		$target = '/' . basename($filePath);
		if (isset($exclude)) {
			if ($pos = strrpos($target, '.')) {
				$name = substr($target, 0, $pos);
				$ext = substr($target, $pos);
			} else {
				$name = $target;
				$ext = '';
			}
			$i = 2;
			$append = '';
			while (in_array($name . $append . $ext, $exclude)) {
				$append = ' (' . $i . ')';
				$i++;
			}
			$target = $name . $append . $ext;
		}
		return $target;
	}

	public function formatItems($items, $format, $parameters = null) {
		return $items;
	}
}
