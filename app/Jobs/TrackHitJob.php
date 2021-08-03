<?php

namespace App\Jobs;

use App\Models\Tracker;
use App\Models\Hit;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TrackHitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $trackerPublicId;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tracker_public_id, Request $request)
    {
        $this->trackerPublicId = $tracker_public_id;
        $this->url = $request->get('url');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tracker = Tracker::where('public_id', $this->trackerPublicId)->first();

        if ($tracker) {
            $hit = Hit::create(['tracker_id' => $tracker->id, 'url' => $this->url]);
            $previousHit = Hit::where('tracker_id', $tracker->id)->orderBy('id', 'desc')->skip(1)->first();
            if ($previousHit) {
                $previousHit->seconds = $hit->created_at->diffInSeconds($previousHit->created_at);
                $previousHit->save();
                return $previousHit->seconds;
            }
            return 0;
            }
        return -1;
    }
}
