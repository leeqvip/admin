<?php

namespace techadmin\controller;

use techadmin\model\Job as JobModel;
use techadmin\model\JobResume;
use techadmin\support\controller\AbstractController;
use think\Request;

class Job extends AbstractController
{
    protected $job;

    protected $category;

    public function __construct(JobModel $job)
    {
        parent::__construct();
        $this->job = $job;
    }

    public function index(Request $request)
    {
        $data = $request->only(['keywords' => '']);

        $jobs = $this->job
            ->when($data['keywords'], function ($query) use ($data) {
                $query->whereLike('position', '%'.$data['keywords'].'%');
            })
            ->order('id', 'desc')
            ->paginate([
                'query' => $data,
            ]);

        return $this->fetch('job/index', [
            'jobs' => $jobs,
        ]);
    }

    public function edit(Request $request)
    {
        $job = $this->job->find($request->get('id', 0));

        return $this->fetch('job/edit', [
            'job' => $job,
        ]);
    }

    public function save(Request $request)
    {
        try {
            $data = $request->post();

            $job = $this->job->create($data, true, true);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->redirect('techadmin.job');
    }

    public function delete(Request $request)
    {
        try {
            $this->job->destroy($request->get('id'));
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }

    public function resume(Request $request, JobResume $jobResume)
    {
        // $job = $this->job->find($request->get('id', 0));
        $resumes = $jobResume->where('job_id', $request->get('id', 0))->paginate();

        return $this->fetch('job/resume', [
            'resumes' => $resumes,
        ]);
    }

    public function resumeItem(Request $request, JobResume $jobResume)
    {
        $resume = $jobResume->find($request->get('id', 0));

        return $this->fetch('job/resumeItem', [
            'resume' => $resume,
        ]);
    }
}
