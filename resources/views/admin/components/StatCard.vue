<template>
    <div
        class="relative overflow-hidden rounded-xl bg-[#FBF8F2] border border-[#E4D8C6] p-5 lg:p-6 transition-all duration-200 hover:shadow-md hover:border-[#D9CAB4] group"
    >
        <!-- Subtle Top Accent Strip (Sesuai Varian) -->
        <div
            :class="[
                'absolute top-0 left-0 right-0 h-1 transition-opacity duration-200',
                accentColorClass
            ]"
        ></div>

        <!-- Header: Label & Icon / Indicator -->
        <div class="flex items-start justify-between gap-3">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[#8A7B6C] leading-tight">
                {{ title }}
            </span>

            <!-- Icon Container -->
            <div
                :class="[
                    'w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-colors',
                    iconBgClass
                ]"
            >
                <slot name="icon">
                    <!-- Default fallback icon jika slot tidak diberikan -->
                    <svg class="w-4 h-4 text-[#C2A878]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 7v5l3 3" />
                    </svg>
                </slot>
            </div>
        </div>

        <!-- Body: Metric Value (Serif Editorial) -->
        <div class="mt-3 flex items-baseline gap-2">
            <span class="font-serif text-3xl lg:text-4xl font-medium tracking-tight text-[#26221F] leading-none">
                {{ value }}
            </span>
            <span
                v-if="unit"
                class="text-xs uppercase tracking-wider text-[#8A7B6C] font-semibold"
            >
                {{ unit }}
            </span>
        </div>

        <!-- Footer: Description & Badge -->
        <div class="mt-3 pt-3 border-t border-[#E4D8C6]/50 flex items-center justify-between gap-2">
            <p class="text-xs text-[#6B5F53] leading-relaxed line-clamp-1">
                {{ description }}
            </p>

            <span
                v-if="badge"
                :class="[
                    'shrink-0 text-[10px] font-semibold tracking-wider uppercase px-2 py-0.5 rounded-full border',
                    badgeClass
                ]"
            >
                {{ badge }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    value: {
        type: [String, Number],
        required: true,
    },
    unit: {
        type: String,
        default: '',
    },
    description: {
        type: String,
        default: '',
    },
    badge: {
        type: String,
        default: '',
    },
    variant: {
        type: String,
        default: 'champagne', // 'champagne' | 'taupe' | 'blush' | 'charcoal'
    },
});

const accentColorClass = computed(() => {
    switch (props.variant) {
        case 'taupe':
            return 'bg-[#8A7B6C]';
        case 'blush':
            return 'bg-[#E2B2B8]';
        case 'charcoal':
            return 'bg-[#26221F]';
        case 'champagne':
        default:
            return 'bg-[#C2A878]';
    }
});

const iconBgClass = computed(() => {
    switch (props.variant) {
        case 'taupe':
            return 'bg-[#E4D8C6]/60 text-[#6B5F53]';
        case 'blush':
            return 'bg-[#F7EFEF] text-[#D48B96]';
        case 'charcoal':
            return 'bg-[#26221F] text-[#FBF8F2]';
        case 'champagne':
        default:
            return 'bg-[#C2A878]/15 text-[#C2A878]';
    }
});

const badgeClass = computed(() => {
    switch (props.variant) {
        case 'taupe':
            return 'bg-[#E4D8C6]/40 text-[#6B5F53] border-[#D9CAB4]';
        case 'blush':
            return 'bg-[#F7EFEF] text-[#963A44] border-[#E2B2B8]/40';
        case 'charcoal':
            return 'bg-[#26221F]/10 text-[#26221F] border-[#26221F]/20';
        case 'champagne':
        default:
            return 'bg-[#C2A878]/15 text-[#8A7B6C] border-[#C2A878]/30';
    }
});
</script>
