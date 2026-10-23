<script module lang="ts">
    import { gallery } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Gallery',
                href: gallery(),
            },
        ],
    };
</script>

<script lang="ts">
    import AppHead from '@/components/AppHead.svelte';
    import Heading from '@/components/Heading.svelte';
    import '@/components/galleries/gfe-gallery-list';
    import { router } from '@inertiajs/svelte';

    type GalleryEvent = CustomEvent<{ id: string }>;

    function viewGallery(event: GalleryEvent) {
        router.visit(`/galleries/${event.detail.id}`);
    }

    function editGallery(event: GalleryEvent) {
        router.visit(`/galleries/${event.detail.id}/edit`);
    }
</script>

<AppHead title="Gallery" />

<h1 class="sr-only">Gallery</h1>

<div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
    <div class="flex flex-col space-y-6">
        <Heading
            variant="small"
            title="Gallery"
            description="Manage your photo galleries"
        />

        <gfe-gallery-list
            ongallery-view={viewGallery}
            ongallery-edit={editGallery}
        ></gfe-gallery-list>
    </div>
</div>
