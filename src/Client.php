<?php

declare(strict_types=1);

namespace GoHighLevelSDK;

use GoHighLevelSDK\Contracts\Auth\OAuthContract;
use GoHighLevelSDK\Contracts\ClientContract;
use GoHighLevelSDK\Contracts\Resources\BusinessContract;
use GoHighLevelSDK\Contracts\Resources\Calendars\CalendarContract;
use GoHighLevelSDK\Contracts\Resources\Campaigns\CampaignContract;
use GoHighLevelSDK\Contracts\Resources\CompanyContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\ContactContract;
use GoHighLevelSDK\Contracts\Resources\Conversations\ConversationContract;
use GoHighLevelSDK\Contracts\Resources\Courses\CourseContract;
use GoHighLevelSDK\Contracts\Resources\Forms\FormContract;
use GoHighLevelSDK\Contracts\Resources\Funnels\FunnelContract;
use GoHighLevelSDK\Contracts\Resources\Invoices\InvoiceContract;
use GoHighLevelSDK\Contracts\Resources\Locations\LocationContract;
use GoHighLevelSDK\Contracts\Resources\Media\LibraryContract;
use GoHighLevelSDK\Contracts\Resources\Opportunities\OpportunityContract;
use GoHighLevelSDK\Contracts\Resources\Payments\PaymentContract;
use GoHighLevelSDK\Contracts\Resources\Products\ProductContract;
use GoHighLevelSDK\Contracts\Resources\SaaS\SaasContract;
use GoHighLevelSDK\Contracts\Resources\Snapshots\SnapshotsContract;
use GoHighLevelSDK\Contracts\Resources\Surveys\SurveysContract;
use GoHighLevelSDK\Contracts\Resources\TriggerLinks\TriggerLinkContract;
use GoHighLevelSDK\Contracts\Resources\Users\UsersContract;
use GoHighLevelSDK\Contracts\Resources\Workflows\WorkflowsContract;
use GoHighLevelSDK\Contracts\TransporterContract;
use GoHighLevelSDK\Resources\Auth\OAuth;
use GoHighLevelSDK\Resources\Business;
use GoHighLevelSDK\Resources\Calendars\Calendar;
use GoHighLevelSDK\Resources\Campaigns\Campaign;
use GoHighLevelSDK\Resources\Company;
use GoHighLevelSDK\Resources\Contacts\Contact;
use GoHighLevelSDK\Resources\Conversations\Conversation;
use GoHighLevelSDK\Resources\Courses\Course;
use GoHighLevelSDK\Resources\Forms\Form;
use GoHighLevelSDK\Resources\Funnels\Funnel;
use GoHighLevelSDK\Resources\Invoices\Invoice;
use GoHighLevelSDK\Resources\Locations\Location;
use GoHighLevelSDK\Resources\Media\Library;
use GoHighLevelSDK\Resources\Opportunities\Opportunity;
use GoHighLevelSDK\Resources\Payments\Payment;
use GoHighLevelSDK\Resources\Products\Product;
use GoHighLevelSDK\Resources\SaaS\Saas;
use GoHighLevelSDK\Resources\Snapshots\Snapshot;
use GoHighLevelSDK\Resources\Surveys\Survey;
use GoHighLevelSDK\Resources\TriggerLinks\TriggerLink;
use GoHighLevelSDK\Resources\Users\User;
use GoHighLevelSDK\Resources\Workflows\Workflow;

final class Client implements ClientContract
{
    private TransporterContract $transporter;

    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(TransporterContract $transporter)
    {
        $this->transporter = $transporter;
    }

    public function businesses(): BusinessContract
    {
        return new Business($this->transporter);
    }

    public function calendars(): CalendarContract
    {
        return new Calendar($this->transporter);
    }

    public function campaigns(): CampaignContract
    {
        return new Campaign($this->transporter);
    }

    public function companies(): CompanyContract
    {
        return new Company($this->transporter);
    }

    public function contacts(): ContactContract
    {
        return new Contact($this->transporter);
    }

    public function conversations(): ConversationContract
    {
        return new Conversation($this->transporter);
    }

    public function courses(): CourseContract
    {
        return new Course($this->transporter);
    }

    public function forms(): FormContract
    {
        return new Form($this->transporter);
    }

    public function invoices(): InvoiceContract
    {
        return new Invoice($this->transporter);
    }

    public function triggerLinks(): TriggerLinkContract
    {
        return new TriggerLink($this->transporter);
    }

    public function location(): LocationContract
    {
        return new Location($this->transporter);
    }

    public function media(): LibraryContract
    {
        return new Library($this->transporter);
    }

    public function funnel(): FunnelContract
    {
        return new Funnel($this->transporter);
    }

    public function opportunity(): OpportunityContract
    {
        return new Opportunity($this->transporter);
    }

    public function Payments(): PaymentContract
    {
        return new Payment($this->transporter);
    }

    public function Products(): ProductContract
    {
        return new Product($this->transporter);
    }

    public function Saas(): SaasContract
    {
        return new Saas($this->transporter);
    }

    public function Snapshot(): SnapshotsContract
    {
        return new Snapshot($this->transporter);
    }

    public function Survey(): SurveysContract
    {
        return new Survey($this->transporter);
    }

    public function User(): UsersContract
    {
        return new User($this->transporter);
    }

    public function Workflow(): WorkflowsContract
    {
        return new Workflow($this->transporter);
    }

    public function oAuth(): OAuthContract
    {
        return new OAuth($this->transporter);
    }
}
