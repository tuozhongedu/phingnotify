<?php
namespace Jiemo\Phing\Notify;

use GuzzleHttp\Client;
use Task;
use ThibaudDauce\Mattermost\Attachment;
use ThibaudDauce\Mattermost\Mattermost;
use ThibaudDauce\Mattermost\Message;

class MattermostTask extends Task
{
    /**
     * The message passed in the buildfile.
     */
    private $title = null;
    private $channel = null;

    /**
     * Notify color
     *
     * @var null
     */
    private $color = null;
    /**
     * hook url
     *
     * @var null
     */
    private $url = null;

    /**
     * notifier
     *
     * @var null
     */
    private $notifierName = null;
    private $notifierAvatar = null;
    private $contentTitle = null;
    private $contentDesc = null;
    private $contentUrl = null;

    private function notify()
    {

        $mattermost = new Mattermost(new Client);

        $message = (new Message)
            ->text($this->title)
            ->channel($this->channel)
            ->username($this->notifierName)
            ->iconUrl($this->notifierAvatar)
            ->attachment(function (Attachment $attachment) {
                $attachment
                    ->color($this->color)
                    ->success()
                    ->text($this->contentDesc)
                    ->authorName($this->contentTitle)
                    ->authorLink($this->contentUrl)
                    ->title($this->contentTitle, $this->contentUrl);
            });

        $mattermost->send($message, $this->url);
    }

    /**
     * The init method: Do init steps.
     */
    public function init()
    {
        // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main()
    {
        $this->notify();
    }

    /**
     * Sets the The message passed in the buildfile.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Sets the value of channel.
     *
     * @param mixed $channel the channel
     *
     * @return self
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Sets the Notify color.
     *
     * @param $color the color
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Sets the hook url.
     *
     * @param $url the url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Sets the notifier.
     *
     * @param $notifierName the notifier name
     *
     * @return self
     */
    public function setNotifierName($notifierName)
    {
        $this->notifierName = $notifierName;
        return $this;
    }

    /**
     * Sets the value of notifierAvatar.
     *
     * @param mixed $notifierAvatar the notifier avatar
     *
     * @return self
     */
    public function setNotifierAvatar($notifierAvatar)
    {
        $this->notifierAvatar = $notifierAvatar;
        return $this;
    }

    /**
     * Sets the value of contentTitle.
     *
     * @param mixed $contentTitle the content title
     *
     * @return self
     */
    public function setContentTitle($contentTitle)
    {
        $this->contentTitle = $contentTitle;
        return $this;
    }

    /**
     * Sets the value of contentDesc.
     *
     * @param mixed $contentDesc the content desc
     *
     * @return self
     */
    public function setContentDesc($contentDesc)
    {
        $this->contentDesc = $contentDesc;
        return $this;
    }

    public function setContentUrl($url)
    {
        $this->contentUrl = $url;
        return $this;
    }
}
