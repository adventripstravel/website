<?php

header('Content-Type: text/xml');

$https = 'https://adventrips.com';
$database = new mysqli('adventrips.com', 'adventrips', 'P2g@y77v', 'adventrips');

$xml =
'<?xml version="1.0" encoding="iso-8859-1"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>' . $https . '/</loc>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>';

if (!$database->connect_error)
{
    $query1 = $database->query('SELECT id, name FROM tours');

    if ($query1->num_rows > 0)
    {
        while ($row = $query1->fetch_assoc())
        {
            $xml .=
            '<url>
                <loc>' . $https . '/booking/' . strtolower(str_replace(' ', '', json_decode($row['name'], true)['es'])) . '/' . $row['id'] . '</loc>
                <changefreq>daily</changefreq>
                <priority>1.00</priority>
            </url>';
        }
    }

    $query2 = $database->query('SELECT token FROM bookings');

    if ($query2->num_rows > 0)
    {
        while ($row = $query2->fetch_assoc())
        {
            $xml .=
            '<url>
                <loc>' . $https . '/voucher/' . $row['token'] . '</loc>
                <changefreq>daily</changefreq>
                <priority>0.80</priority>
            </url>';
        }
    }
}

$xml .=
'   <url>
        <loc>' . $https . '/contact</loc>
        <changefreq>yearly</changefreq>
        <priority>0.60</priority>
    </url>
    <url>
        <loc>' . $https . '/terms</loc>
        <changefreq>yearly</changefreq>
        <priority>0.60</priority>
    </url>
</urlset>';

$database->close();

echo $xml;
