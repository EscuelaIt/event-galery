<script lang="ts">
    let {
        class: className = '',
        ...rest
    }: {
        class?: string;
        [key: string]: unknown;
    } = $props();
</script>

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 40 40"
    class={className}
    {...rest}
>
    <!-- Background frame -->
    <rect
        x="4"
        y="4"
        width="32"
        height="32"
        rx="4"
        ry="4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
    />
    
    <!-- Top left image frame -->
    <rect
        x="6"
        y="6"
        width="14"
        height="14"
        rx="2"
        ry="2"
        fill="currentColor"
        opacity="0.2"
    />
    <circle cx="12" cy="10" r="2" fill="currentColor" />
    <path
        d="M6 18L11 13L15 17L20 12"
        stroke="currentColor"
        stroke-width="1.5"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Top right image frame -->
    <rect
        x="22"
        y="6"
        width="12"
        height="14"
        rx="2"
        ry="2"
        fill="currentColor"
        opacity="0.2"
    />
    <circle cx="26" cy="10" r="1.5" fill="currentColor" />
    <path
        d="M22 18L26 14L28 16L34 10"
        stroke="currentColor"
        stroke-width="1.5"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Bottom left image frame -->
    <rect
        x="6"
        y="22"
        width="14"
        height="12"
        rx="2"
        ry="2"
        fill="currentColor"
        opacity="0.2"
    />
    <circle cx="11" cy="26" r="1.5" fill="currentColor" />
    <path
        d="M6 30L10 26L13 29L20 22"
        stroke="currentColor"
        stroke-width="1.5"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Calendar/Event star in bottom right -->
    <g transform="translate(28, 28)">
        <circle cx="0" cy="0" r="5" fill="currentColor" opacity="0.2" />
        <path
            d="M 0,-3 L 0.9,-0.9 L 3,-0.3 L 1.5,1.2 L 1.8,3.3 L 0,2.1 L -1.8,3.3 L -1.5,1.2 L -3,-0.3 L -0.9,-0.9 Z"
            fill="currentColor"
        />
    </g>
</svg>
