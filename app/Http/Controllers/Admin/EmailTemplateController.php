<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Models\Backend\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Valid columns in `email_templates` table (`id`, `name`, `group`, `text`, `status`, `sort`).
     *
     * @var array<int, string>
     */
    protected array $emailTemplateColumns = [
        'name',
        'group',
        'text',
        'status',
        'sort',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = EmailTemplate::filter($request)->orderByDesc('sort')->paginate(20)->appends($request->all());

        $total_item = $data->total();

        return view('backend.email-template.index', compact('data', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arrayGroup = $this->arrayGroup();

        return view('backend.email-template.single', compact('arrayGroup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmailTemplateRequest $request)
    {
        $data = $this->preparePayload($request);

        $shortcode = EmailTemplate::create($data);
        $insert_id = $shortcode->id;

        if (empty($data['sort'])) {
            $shortcode->update(['sort' => $insert_id]);
        }

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            return redirect()->route('admin.email-template.edit', [$insert_id])->with('success', __('Thêm mẫu email thành công!'));
        }

        return redirect(route('admin.email-template.index'))->with('success', __('Thêm mẫu email thành công!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate, $id)
    {
        EmailTemplate::findOrFail($id);

        return redirect()->route('admin.email-template.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate, $id)
    {
        $arrayGroup = $this->arrayGroup();
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplate->code = $emailTemplate->group;

        return view('backend.email-template.single', compact('emailTemplate', 'arrayGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailTemplateRequest $request, $id)
    {
        $templateId = $id ?: $request->input('id');
        $emailTemplate = EmailTemplate::findOrFail($templateId);

        $data = $this->preparePayload($request, $emailTemplate);
        $emailTemplate->update($data);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            return redirect()->route('admin.email-template.edit', [$emailTemplate->id])->with('success', __('Cập nhật mẫu email thành công!'));
        }

        return redirect(route('admin.email-template.index'))->with('success', __('Cập nhật mẫu email thành công!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate, $id)
    {
        $emailTemplate->findOrFail($id)->delete();

        return redirect()->route('admin.email-template.index')->with('success', __('Xóa mẫu email thành công!'));
    }

    /**
     * Sanitize and whitelist fields for `email_templates` table.
     *
     * @return array<string, mixed>
     */
    protected function preparePayload(Request $request, ?EmailTemplate $existing = null): array
    {
        $data = $request->only($this->emailTemplateColumns);

        $data['name'] = $request->input('name') ?? ($existing?->name ?? '');
        $data['group'] = $request->input('group') ?? $request->input('code') ?? ($existing?->group ?? '');
        $data['text'] = $request->input('text') ?? $request->input('content') ?? ($existing?->text ?? '');
        $data['status'] = (int) ($request->input('status') ?? ($existing?->status ?? 1));

        return $data;
    }

    public function arrayGroup()
    {
        return [
            'contact' => 'Inform contact to user',
            'contact_admin' => 'Inform contact to admin',
            'contact_setup' => 'Inform setup to admin',
            'transaction_register' => 'Inform transaction register to user',
            'transaction_register_admin' => 'Inform transaction register to admin',
            'purchase' => 'Inform purchase to user',
            'purchase_admin' => 'Inform purchase to admin',
        ];
    }
}
