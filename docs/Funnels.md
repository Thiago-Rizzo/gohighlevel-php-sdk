## Working with Funnels

```php
$version = '2021-07-28';
$ghl = \GoHighLevelSDK\GoHighLevel::init($access_token);
$funnels = $ghl->withVersion($version)
                ->make()
                ->funnel()
                ->list($locationId);

```
