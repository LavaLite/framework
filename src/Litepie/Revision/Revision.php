<?php

namespace Litepie\Revision;

class Revision
{
    /**
     * $revision object.
     */
    protected $revision, $activity;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Revision\Interfaces\RevisionRepositoryInterface $revision,
                                \Litepie\Revision\Interfaces\ActivityRepositoryInterface $activity)
    {
        $this->revision = $revision;
        $this->activity = $activity;
    }

    /**
     * Returns count of revision.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return 0;
        /*$email = user(getenv('guard'))->email;
        $this->revision->pushCriteria(new \Litepie\Revision\Repositories\Criteria\RevisionUserCriteria());
    
        return $this->revision->scopeQuery(function ($query) use ($slug) {
                return $query->with('user')->whereStatus($slug)->where("read", "=", 0)->orderBy('id', 'DESC');
            })->count();*/
       
    }
 
    /**
     * latest news.
     * @param int $count
     * @param string $view
     *
     * @return string
     */
    public function revision($count = 10, $view = 'user.revision.gadget')
    {
        $revision = $this->revision
            ->pushCriteria(new \Litepie\Revision\Repositories\Criteria\RevisionUserCriteria())
            ->scopeQuery(function ($query) use ($count) {
                return $query->with('user')->orderBy('id', 'DESC')->take($count);
            })->all();

        return view('revision::' . $view, compact('revision'))->render();
    }

    /**
     * latest news.
     * @param int $count
     * @param string $view
     *
     * @return string
     */
    public function activity($count = 10, $view = 'user.activity.gadget')
    {

        $activity = $this->activity
            ->pushCriteria(new \Litepie\Revision\Repositories\Criteria\RevisionUserCriteria())
            ->scopeQuery(function ($query) use ($count) {
                return $query->orderBy('id', 'DESC')->take($count);
            })->all();

        return view('revision::' . $view, compact('activity'))->render();
    }

}
