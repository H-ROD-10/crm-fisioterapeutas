<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function appointments()
    {
        return view('landing.features.appointments');
    }

    public function billing()
    {
        return view('landing.features.billing');
    }

    public function clinicalHistory()
    {
        return view('landing.features.clinical-history');
    }

    public function reminders()
    {
        return view('landing.features.reminders');
    }

    public function aiPhone()
    {
        return view('landing.features.ai-phone');
    }

    public function whatsappBot()
    {
        return view('landing.features.whatsapp-bot');
    }

    public function virtualAssistant()
    {
        return view('landing.features.virtual-assistant');
    }

    public function aiCalls()
    {
        return view('landing.features.ai-calls');
    }

    public function smartTranscription()
    {
        return view('landing.features.smart-transcription');
    }

    public function marketing()
    {
        return view('landing.features.marketing');
    }
}
