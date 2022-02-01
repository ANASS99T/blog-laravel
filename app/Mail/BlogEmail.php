<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $blog;

    public function __construct(Blog $blog)
    {
        //
        // dd($blog);
        $this->blog = $blog;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       

        return $this
            ->from('a.ouledbentahar@e-solution.ma')
            // ->to('anass.taher@gmail.com')
            ->subject('New blog shared')
            ->view('email.index')
            ->with(['blog'=>$this-> blog]);
    }
}
