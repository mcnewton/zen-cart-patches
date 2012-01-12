Download-Scripts addon package for Zen Cart
-------------------------------------------

SYNOPSIS

This package gives a basic way of extending Zen Cart to run scripts
that process downloads bought through the shop. Examples may be to
host files on Amazon S3 storage and to allow downloads from there, or
to watermark a PDF file as part of the download process.


AUTHOR

Copyright (c) Matthew Newton, 2011
Zen Forum: mcnewton

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.


PACKAGE CONTENTS

For files that are modified or added by this package, please see the
contents of MANIFEST-downloadscripts.txt.

Patches are at https://github.com/mcnewton/zen-cart-patches
in the branch 'package-dlscripts'.


INSTALLATION

Installation is in three parts. First the files need to be copied in
to place. Second, scripts need to be written to handle the downloads
(an example is given for Amazon S3). Finally, downloads in Zen Cart
need to be configured to use the script.


Part 1 - Installing the files

First, make a backup of your Zen Cart shop files and database.

Test this on a copy of your shop before installing on a live
site.

Copy the contents of this archive to the root directory of your
shop.


Part 2 - Setting up the script

Each download PHP script should use the following variables to
decide where to redirect the browser to:

  $db - database handle
  $origin_filename - name of the script
  $browser_filename - name of the file requested to download
  $script_opts - extra options passed from the interface

It is suggested that these are passed to a function to do the
actual work to protect from variable clashes with the calling Zen
Cart environment. The script should work out what URL to redirect
the browser to that allows them to download the specified file.
It should then should send an HTTP redirect back to the browser
for the URL.

For an example, see dlscripts/amazons3.php. This uses an Amazon
S3 key and secret to cryptographically sign a request for a file
on S3 with a download expiry time of 30 seconds from now. This
protects the files on S3, as the purchaser will not be able to
store the URL and distribute it (prohibiting distribution of the
actual downloaded files is another matter, but at least you will
not be charged for it coming from your S3 account!)

The script options are passed from the Zen Cart interface, and
contain the Zen Cart download 'filename' split on colons (see
comment at the top of the example). The example also shows how
you could set the Amazon S3 'bucket' using the Zen Cart
interface, should you want to use different buckets.


Part 3 - Configuring downloads in the shop

To enable a script to run for a download, rather than Zen Cart
serving the file directly, use the following for the filename in
the shop admin interface:

  script:scriptname.php:filename:filesize

For example, to use the Amazon S3 download script, and to tell it
to download a video, "shopping.mpg", which is 152Mb, you would
use:

  script:amazons3.php:shopping.mpg:152Mb

(The file size is shown to the customer on the download page after
they have bought the item.)


COPYING

The files in this package are free software: you can redistribute
it and/or modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, either
version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>


VERSION HISTORY

1.0   11 Jan 2012   Initial release for Zen Cart 1.3.9h

