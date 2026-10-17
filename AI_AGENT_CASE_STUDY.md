<div align="center">

# BOX Sneakers — AI Customer Assistant

### AI-assisted ecommerce support with verified knowledge, order-data boundaries and human takeover

**WooCommerce · Conversational AI · Chatwoot · Python · REST APIs**

[Visit BOX Sneakers](https://box-sneakers.com/) · [BOX Ecommerce Engineering](./README.md) · [SlantFlow](https://slantflow.com/)

</div>

---

## 1. Project Overview

BOX Sneakers is a WooCommerce sneaker retailer with ecommerce operations covering products, customer inquiries, orders, shipping and customer support. This case study documents the AI-assistant engineering work and integration approach in that environment.

The assistant is intended to support natural-language customer conversations while respecting the distinction between **approved store information** and **live customer/order records**.

> **Verification note:** This document distinguishes documented work and design patterns from features that require current deployment verification. It is not a declaration that every feature described below is active in production.

## 2. Business Problem

Customer-support conversations often involve repeated product questions and sensitive order-specific requests.

The engineering goals are to:
- Use verified store facts instead of invented answers.
- Preserve customer context across turns without collecting unnecessary personal data.
- Retrieve order or fulfillment status only through authorized integrations.
- Support employee takeover and avoid AI replies after takeover.
- Prevent duplicate outbound messages during retries.
- Observe API use and failed operations.

No unsupported conversion, savings, or response-time metrics are claimed.

## Self-Hosted Customer Service Deployment

The BOX AI engineering approach uses a **self-hosted customer-conversation platform built on Chatwoot** as the messaging and human-support layer. Chatwoot provides the operational inbox; SlantFlow's work concerns the deployment, store integrations, knowledge handling, assistant behavior and handoff controls. The underlying platform is not presented as proprietary technology invented by SlantFlow. Specific production features and current availability must be confirmed before being advertised as live.

## 3. Solution Components

### Conversational layer
A natural-language assistant can interpret customer intent and generate concise store-appropriate responses. Language and tone are separate from store facts, customer identity and operational permissions.

### Knowledge layer
Approved store policies, product/service facts and FAQs must be versioned independently of customer-specific database state. If a fact is missing or stale, the agent should ask for clarification or transfer instead of inventing it.

### Authorized business tools
Order retrieval, product availability, shipping events, payments, returns and fulfillment decisions require authenticated, purpose-built application integration. AI-generated text is not proof that a business operation completed.

### Human handoff
The messaging integration needs to recognize a human takeover, pause the assistant, and suppress queued automated replies or follow-ups where applicable.

### Delivery safeguards
Inbound event deduplication, queue/state checks, retries and outbound idempotency are important architectural controls. Message receipt, AI generation and confirmed delivery are distinct stages.

## 4. Reference Data Flow

```text
Customer on messaging channel
          |
          v
Inbound webhook / event validation
          |
          v
Conversation context + safety state
          |
     +----+--------------------+
     |                         |
     v                         v
Approved store knowledge   Authorized store APIs
     |                         |
     +-----------+-------------+
                 |
                 v
          AI response logic
                 |
                 v
     Delivery guard / human pause
                 |
           +-----+------+
           |            |
           v            v
      Send reply    Human takeover
```

This is an engineering reference flow, not a public copy of production source.

## 5. Operational Safeguards

| Area | Design principle |
| --- | --- |
| Customer data | No private record should be accessed without authorization |
| Order status | Verify through a live tool before confirming |
| AI confidence | Do not present unverified claims as store facts |
| Human reply | Human takeover has priority over pending AI messages |
| Duplicates | Avoid repeat deliveries on retries |
| Observability | Keep an audit trail of actions and failures |
| Privacy | Do not expose customer chats, API keys, tokens or private IDs |

## 6. Scope / Status Clarity

**Relevant documented experience:** WooCommerce operational integrations, customer-service bot architecture, verified-knowledge handling, Chatwoot/handoff workflows, queue safeguards and production infrastructure.

**Require release-level confirmation before marketing as live:** vision/image support, voice transcription, autonomous follow-ups, AI-initiated booking, live product/stock queries, specific order-management actions, model routing and any quantitative performance results.

## 7. Testing Approach

Useful acceptance scenarios include:
1. Standalone greeting does not trigger unwanted sales claims.
2. Product question uses approved, current product data.
3. Order-status question without authorization does not expose another customer's information.
4. Staff handoff suppresses further bot replies.
5. Replayed webhook does not duplicate delivery.
6. API outage yields a safe response without false success.
7. A closed conversation does not receive an unapproved follow-up.

These are **recommended validation scenarios**, not a declaration that every test has passed.

## 8. Deployment & Confidentiality

This case study intentionally excludes proprietary repositories, customer conversations, database credentials, access tokens, server IPs and production private endpoints.

For the public BOX AI trial, a WhatsApp test number or link should be published only after the owner verifies it is active and authorized for testing.

---

**Explore the wider project:** [BOX Sneakers WooCommerce case study](./README.md)

**Contact:** [SlantFlow](https://slantflow.com/contact/)
