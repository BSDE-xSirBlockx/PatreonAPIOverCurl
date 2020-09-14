<?php

namespace Patreon;

class PatreonAPI {

    protected $access_token;

    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    public function getCampaignID(): string
    {
        $campaign_id_curl = curl_init();
        curl_setopt($campaign_id_curl, CURLOPT_URL, "https://www.patreon.com/api/oauth2/api/current_user");
        curl_setopt($campaign_id_curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($campaign_id_curl, CURLOPT_HTTPHEADER, ['authorization: Bearer '.$this->access_token]);
        $campaign_id = json_decode(curl_exec($campaign_id_curl))->data->relationships->campaign->data->id;
        curl_close($campaign_id_curl);
        return $campaign_id;
    }

    public function getAllPatreons(): object
    {
        $patrons_curl = curl_init();
        curl_setopt($patrons_curl, CURLOPT_URL, "https://www.patreon.com/api/oauth2/api/campaigns/".$this->getCampaignID()."/pledges?include=patron.null");
        curl_setopt($patrons_curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($patrons_curl, CURLOPT_HTTPHEADER, ['authorization: Bearer '.$this->access_token]);
        $res = json_decode(curl_exec($patrons_curl));
        curl_close($patrons_curl);
        return $res;
    }

    public function getAllActivePatreons(): array
    {
        $result = $this->getAllPatreons()->data;
        $patreons = [];

        foreach($result as $patron) {
            if($patron->attributes->declined_since == NULL) {
                $patreons[] = $patron;
            }
        }
        return $patreons;
    }

}