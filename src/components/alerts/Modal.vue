<template>
  <div>
    <!-- modal bootstrap -->
    <div
      class="modal fade"
      id="myModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ modal.header }}
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ modal.body }}
          </div>
          <div class="modal-footer">
            <button
              v-if="modal.btn1"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="$emit('btn1')"
            >
              {{ modal.btn1.text }}
            </button>
            <button
              v-if="modal.btn2"
              type="button"
              class="btn btn-primary"
              @click="$emit('btn2')"
            >
              {{ modal.btn2.text }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<!--
    struktura modal: {
        header,
        body,
        btn1: {
            text,
        },
        btn2: {
            text,
        }
    }
    event names:
    - btn1
    - btn2
-->
<script>
export default {
  props: ["modal"],
}
</script>

<style lang="scss" scoped></style>
