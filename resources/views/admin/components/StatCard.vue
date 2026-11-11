<template>
    <div
        :class="[
            'relative overflow-hidden rounded-2xl border transition-all duration-200 hover:shadow-lg group',
            cardBgClass
        ]"
    >
        <!-- Left Accent Stripe (Vertical, 3px — lebih editorial dari strip atas) -->
        <div
            :class="[
                'absolute top-0 left-0 bottom-0 w-[3px]',
                accentColorClass
            ]"
        ></div>

        <!-- Inner Content -->
        <div class="pl-7 pr-5 pt-6 pb-5 lg:pl-8 lg:pr-6">
            <!-- Label + Icon Row -->
            <div class="flex items-start justify-between gap-3">
                <span
                    :class="[
                        'text-[10px] font-semibold uppercase tracking-[0.22em] leading-none',
                        labelColorClass
                    ]"
                >
                    {{ title }}
                </span>

                <!-- Icon Container -->
                <div
                    :class="[
                        'w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors',
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

            <!-- Main Metric: Number + Unit -->
            <div class="mt-4 flex items-baseline gap-2">
                <span
                    :class="[
                        'font-serif leading-none tracking-tight',
                        featured ? 'text-5xl sm:text-6xl' : 'text-4xl sm:text-5xl',
                        valueColorClass
                    ]"
                >
                    {{ value }}
                </span>
                <span
                    v-if="unit"
                    :class="[
                        'text-[11px] uppercase tracking-widest font-semibold',
                        unitColorClass
                    ]"
                >
                    {{ unit }}
                </span>
            </div>

            <!-- Description -->
            <p
                v-if="description"
                :class="[
                    'mt-2.5 text-[11px] leading-relaxed line-clamp-2',
                    descColorClass
                ]"
            >
                {{ description }}
            </p>
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
    featured: {
        type: Boolean,
        default: false,
    },
});

const cardBgClass = computed(() => {
    switch (props.variant) {
        case 'charcoal':
            return 'bg-[#26221F] border-[#3D3732]';
        default:
            return 'bg-[#FBF8F2] border-[#E4D8C6] hover:border-[#D9CAB4]';
    }
});

const accentColorClass = computed(() => {
    switch (props.variant) {
        case 'taupe':
            return 'bg-[#8A7B6C]';
        case 'blush':
            return 'bg-[#D48B96]';
        case 'charcoal':
            return 'bg-[#C2A878]';
        case 'champagne':
        default:
            return 'bg-[#C2A878]';
    }
});

const labelColorClass = computed(() => {
    switch (props.variant) {
        case 'charcoal':
            return 'text-[#6B5F53]';
        default:
            return 'text-[#8A7B6C]';
    }
});

const valueColorClass = computed(() => {
    switch (props.variant) {
        case 'charcoal':
            return 'text-[#FBF8F2]';
        default:
            return 'text-[#26221F]';
    }
});

const unitColorClass = computed(() => {
    switch (props.variant) {
        case 'charcoal':
            return 'text-[#6B5F53]';
        default:
            return 'text-[#8A7B6C]';
    }
});

const descColorClass = computed(() => {
    switch (props.variant) {
        case 'charcoal':
            return 'text-[#6B5F53]';
        default:
            return 'text-[#6B5F53]';
    }
});

const iconBgClass = computed(() => {
    switch (props.variant) {
        case 'taupe':
            return 'bg-[#E4D8C6]/60';
        case 'blush':
            return 'bg-[#F7EFEF]';
        case 'charcoal':
            return 'bg-[#FBF8F2]/10';
        case 'champagne':
        default:
            return 'bg-[#C2A878]/15';
    }
});

// Dipertahankan untuk kompatibilitas (tidak dirender di template)
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
