WOOCOMMERCE-CUSTOM-ORDER-SQL-DATA
=================================

TO DO:
I hope to fix the way the database is being saved(currently being input
into an array) therefore when I want to add a field from the database
into the data-array it requires another input array [look @
$SQLQUERYFOUR[$i+3] (LINE 19) for more].


=======================THE PROBLEM==========================

I am a web developer and I have a client (The Loft) that I've made a zencart site for (depricated), and a new site (Wordpress with Woocommerce).

My client puts on events/shows on a stage at their location, and therefore we use woocommerce to sell tickets to our shows.

We had an issue with the reporting system in Woocommerce.

I found that the plug-ins for "Woocommerce custom order reports" were not working with my wordpress installation. 

++++++++++++++++++++++THE SOLUTION++++++++++++++++++++++++++++++++++++++++
Therefore I wrote this code to find out "WHAT PEOPLE BOUGHT" and "WHO BOUGHT TICKETS FOR WHAT SHOW".

This required searching for hours on finding the tables that woocommerce sotres order data in then writing PHP and SQL code to join two tables and grab the information we needed.


==========================THE DATA===================================


WOOCOMMERCE stores data in four tables:
To be clear, in WooCommerce 2.x, orders are stored in the 

post table, 
postmeta table, 
woocommerce_order_items, and 
woocommerce_order_itemmeta tables. 

Various parts of an order are stored in different tables.

THE CODE in SQL CODE.php does a database query in SQL (using PHP) takes in arrays of data from the database, stores the arrays into a data-array, then a foreach loop sorts through the array and grabs the data we need form the woocommerce order information.
It grabs the information from the wp_postmeta and wp_order_items tables and parses through the data to output on a wordpress page. 
I made a page template in wordpress and made a protected page (requires password or wpadmin access) to output the information to, and therefore just placed this code on the template.php for my theme. 


THIS LINE FROM THE SQL QUERY IS IMPORTANT:
wp_postmeta.post_id=wp_woocommerce_order_items.order_id

This tells us that the relationship (key) between wp_postmeta and p_woocommerce_order_items has a shared column/field. 
Meaning "post_id" in "wp_postmeta" is the same as "order_id" in "wp_woocommerce_order_items".
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


=========================THE OUTPUT======================================


The fields that we grabbed from the data-array and created variables for, are as follows:
post_id
order_id
BILLING FIRST NAME
BILLING LAST NAME
BILLING EMAIL
USERAGENT
ORDER_ITEM_NAME


We were also having an issue with double orders happening on some devices (its a responsive site), and therefore included the USERAGENT so we could tell what devices were having the issue. IPHONES OF COURSE!!!!!!!!!!

Once we sorted through all the data and found the things we wanted to output it was pretty simple in getting the data formatted. 

THE THING THAT TOOK THE MOST TIME: sorting through all the data to find what we needed.













