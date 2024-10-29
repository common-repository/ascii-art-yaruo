#!/usr/bin/perl -w
#
#  mlt file spliter
#
# ./split.pl file_name.mlt [prefix]
#
#

use strict;
use warnings;
use utf8;
use File::Basename 'fileparse';
use File::Spec;
use NKF;

my $file = $ARGV[0];
my $prefix = $ARGV[1] ? $ARGV[1] : '';

my ($basename, $dirname, $ext) = fileparse($file, qr/\..*$/);
my $dir = $basename;
if (! -d $dir) {
	mkdir ($dir);
}

open( my $in, $file) || die "$!";

my $list_file_name = File::Spec->catfile($dir, '_list.html');
open(LIST, ">" . $list_file_name) || die "$!";
my $header_html = <<"EOD";
<html><head>
<meta charset="UTF-8">
<style type='text/css'>
<!--
	font-size: 16px;
	line-height: 18px;
	font-family: 'Mona','IPA MONAPGOTHIC','MS PGothic','ＭＳ Ｐゴシック','MS Pゴシック', Saitamaar, sans-serif;
-->
</style>
<link rel="stylesheet" href="../../css/style.css">
</head><body>
EOD
print (LIST nkf('-w', $header_html));

my $count = 0 ;
my $skip = 0;
my $buf;
my $pattern = nkf("-w" , "^(【.*】|最終更新日)");

while( <$in> ) {
	$_ = nkf("-w -x --ic=CP932", $_);

	if (/$pattern/) {

		$skip = 1;

	} elsif (/^\[SPLIT/) {
		if ($skip != 1) {
			$count += 1;

			my $output_file_name = File::Spec->catfile($dir, $prefix . $count . '.txt');
			open(OUT, ">" . $output_file_name) || die "$!";
			print(OUT $buf);
			close(OUT);

			my $brbuf = $buf;
			$brbuf =~ s/\n/<br>/g;
			print(LIST "<h1>id:$count</h1>\n<figure class='aa_panel'><div class='aa'>" .
						$brbuf . "</div></figure>\n")
		}
		$buf = "";
		$skip = 0;

	} else {

		$buf = $buf . $_;

	}

}

print(LIST "</body></html>");
close(LIST);
