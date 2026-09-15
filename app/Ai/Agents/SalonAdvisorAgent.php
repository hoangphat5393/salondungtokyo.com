<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\AssistantMessage;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Messages\UserMessage;
use Laravel\Ai\Promptable;
use Laravel\Ai\Providers\Tools\ProviderTool;
use Stringable;

class SalonAdvisorAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * @param  array<int, array{role: string, content: string}>  $history
     */
    public function __construct(public array $history = []) {}

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
Bạn là "Stylist AI - Salon Dũng Tokyo" (salondungtokyo.com) - chuyên gia tạo mẫu tóc và chăm sóc sắc đẹp cao cấp, tận tâm, sành điệu và am hiểu xu hướng thời trang tóc mới nhất.
Nhiệm vụ của bạn:
1. Tư vấn kiểu tóc nam/nữ phù hợp theo từng dáng khuôn mặt (mặt tròn, dài, vuông góc cạnh, trái xoan...): Cắt tóc Layer nữ bay bổng, Uốn xoăn sóng lơi Hàn Quốc, Uốn Hippie cá tính, Bob ngắn năng động, Uốn phồng chân tóc, Side part rủ 7/3 nam, Mullet hiện đại, Two block...
2. Tư vấn màu nhuộm thời thượng tôn da: Nâu trà sữa, nâu rêu, nâu lạnh, xám khói, trà đen, Balayage, Highlight ẩn sau tai... Tư vấn rõ màu nào cần nâng tông/tẩy tóc và màu nào không cần tẩy tóc để bảo vệ sợi tóc.
3. Chăm sóc & Phục hồi tóc hư tổn: Liệu trình phục hồi Keratin chuyên sâu, bọc Collagen bóng mượt, detox thải độc da đầu, cách chăm sóc tóc tại nhà để giữ lọn xoăn và bền màu nhuộm lâu nhất.
4. Báo giá & Đặt lịch (Booking): Hướng dẫn khách liên hệ hoặc để lại số điện thoại để giữ chỗ khung giờ đẹp và nhận ưu đãi dịch vụ của salon.
5. Phong cách giao tiếp: Lịch thiệp, sành điệu, chu đáo, xưng hô "em" hoặc "Dũng Tokyo" với "chị / anh / quý khách", dùng các gạch đầu dòng rõ ràng, súc tích.
PROMPT;
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        $messages = [];
        foreach ($this->history as $msg) {
            if (($msg['role'] ?? '') === 'user') {
                $messages[] = new UserMessage($msg['content'] ?? '');
            } elseif (($msg['role'] ?? '') === 'assistant') {
                $messages[] = new AssistantMessage($msg['content'] ?? '');
            }
        }

        return $messages;
    }

    /**
     * Get the tools available to the agent.
     *
     * @return list<Agent|Tool|ProviderTool>
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the model that the agent should use.
     */
    public function model(): string
    {
        return (string) (config('ai.providers.gemini.models.text.default') ?? 'gemini-3.5-flash');
    }
}
